const WP_API_URL = 'http://52.18.72.234/klefstromlab/wp-json/wp/v2/';

export function getPost(id) {

  return {"post" :
  {"id":1,"date":"2016-09-10T19:15:44","date_gmt":"2016-09-10T19:15:44",
    "guid":{"rendered":"http:\/\/52.18.72.234\/klefstromlab\/?p=1"},
    "modified":"2016-09-10T19:15:44","modified_gmt":"2016-09-10T19:15:44",
    "slug":"hello-world","type":"post","link":"http:\/\/52.18.72.234\/klefstromlab\/hello-world\/",
    "title":{"rendered":"Hello world!"},
    "content":{"rendered":"<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!<\/p>\n","protected":false},
    "excerpt":{"rendered":"<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!<\/p>\n","protected":false},
    "author":1,"featured_media":0,"comment_status":"open","ping_status":"open","sticky":false,"format":"standard",
    "categories":[1],"tags":[],
    "_links":{"self":[{"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/posts\/1"}],
      "collection":[{"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/posts"}],"about":[{"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/types\/post"}],"author":[{"embeddable":true,"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/users\/1"}],"replies":[{"embeddable":true,"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/comments?post=1"}],"version-history":[{"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/posts\/1\/revisions"}],"wp:attachment":[{"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/media?parent=1"}],"wp:term":[{"taxonomy":"category","embeddable":true,"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/categories?post=1"},{"taxonomy":"post_tag","embeddable":true,"href":"http:\/\/52.18.72.234\/klefstromlab\/wp-json\/wp\/v2\/tags?post=1"}],
      "curies":[{"name":"wp","href":"https:\/\/api.w.org\/{rel}","templated":true}]}}};
  /*var request = new XMLHttpRequest();
  request.open('GET', WP_API_URL + 'posts/' + id, true);

  request.onload = function () {
    if (request.status >= 200 && request.status < 400){ //check these
      // Success!
      return request.response;

    } else {
      // We reached our target server, but it returned an error
      console.log("returns something else than success")

    }
  };

  request.onerror = function () {
    // There was a connection error of some sort
    console.log("connection error");
  };

  request.send();*/
}


