var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost/web-programming-2024/backend/rest/";
    } else {
      return "https://sea-turtle-app-oa8l2.ondigitalocean.app/backend/rest/";
    }
  },
};
