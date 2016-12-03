var startEditButton = require("./componentTemplates/startEdit.handlebars");

export default class BaseFunctionality {
  constructor() {
    console.log("base is constructing");

    let facebookFeedItems = document.querySelectorAll('.facebook-feed .cff-item');
    Array.from(facebookFeedItems).map(elem => {
      console.log(elem);
      elem.querySelectorAll()
      Array.from(elem
      if (elem.classList.contains("cff-video-post")){
        console.log("VIDEO : "+ elem);
      }
      //remove: cff-shared-link
    });
    /*var elems = document.querySelectorAll('#posti');
    Array.prototype.map.call(elems, obj => {
        console.log(obj.valueOf());
        var div = document.createElement('div');
        div.innerHTML = startEditButton({});
        var para = document.createElement("P");                       // Create a <p> element
        var t = document.createTextNode("This is a paragraph");       // Create a text node
        para.appendChild(t);
        obj.appendChild(div);
        //document.body.insertBefore(div, obj);
        console.log(obj.valueOf());
      }
    )*/
  }
}
