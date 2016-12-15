var startEditButton = require("./componentTemplates/startEdit.handlebars");

class Editor {
  constructor(props) {
    var elems = document.querySelectorAll('#posti');
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
    )
  }
}

function ready(fn) {
  if (document.readyState != 'loading'){
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

ready(function(){new Editor()});


