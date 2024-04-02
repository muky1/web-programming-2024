function fetchBlogSummary () {
    fetch('assets/blogs.json')
    .then(response => response.json())
    .then(blogs => {
        const summaryContainer = document.getElementById('blog-summary-container');
        summaryContainer.innerHTML = '';

        blogs.forEach(blog => {
            const blogElement = document.createElement('div');
            blogElement.className = 'flex flex-col bg-white rounded-lg shadow-md overflow-hidden w-[400px]';
            blogElement.innerHTML = `
            <div class="p-6">
                <h3 class="font-bold text-lg mb-3">${blog.title}</h3>
                <p class="text-gray-700 text-base h-24 overflow-hidden">${blog.summary}</p>
            </div>
            <div class="px-6 py-4 bg-gray-100 mt-auto">
                <span class="text-sm text-gray-600">${new Date(blog.date).toLocaleDateString()}</span>
                <a href="#" class="text-blue-500 text-sm float-right" onclick="loadBlogDetails(${blog.id})">Read more</a>
            </div>
            `;
            summaryContainer.appendChild(blogElement);
        });

    }).catch(error => console.error('Error catching the blog posts:', error))
}

function loadBlogDetails (blogId) {
    fetch('assets/blogs.json')
    .then(response => response.json())
    .then(blogs => {
        const blog = blogs.find(b => b.id === blogId);
        if (blog) {
            const mainContent = document.getElementById('main-content');
            mainContent.innerHTML = `
            <div class="container mx-auto px-4 py-8">
                <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="mb-4">
                    <h2 class="text-3xl font-bold text-gray-900">${blog.title}</h2>
                    <div class="flex justify-between items-center text-gray-600">
                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm">${blog.category}</span>
                        <span>${new Date(blog.date).toLocaleDateString()}</span>
                    </div>
                </div>
                <div class="prose lg:prose-xl">
                    ${blog.content}
                </div>
                <div id="comments-section" class="mt-8">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Comments</h3>
                    <button id="view-comments-btn" class="mb-4 bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                        View Comments
                    </button>
                    <div id="comments-container" class="space-y-4">
                        <!-- Comments will be dynamically loaded here -->
                        <p class="text-gray-600">No comments yet.</p>
                    </div>
                </div>
                </div>
            </div>
          `;
          // Optionally update the URL and page title
          document.title = blog.title;
          window.history.pushState({id: blogId}, blog.title, `index.html/blog-${blogId}`);
        }
    })
    
}

window.addEventListener('popstate', function(event) {
    // You might want to check `event.state` to decide what to do
    if (event.state && event.state.id) {
      loadBlogDetails(event.state.id);
    } else {
      // Handle other cases or load a default page
      //window.history.pushState('/')
    }
});

document.addEventListener('DOMContentLoaded', fetchBlogSummary);
