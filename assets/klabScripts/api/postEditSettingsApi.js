/**
 * Created by aino on 23.10.2016.
 */

export function getPostSettings(postTypeSlug) {

  return {"formSettings" :
  {"postType": "posts",
      "inputFields" :
         [
      {
        "key": "title.rendered",
        "attributes": {
          "type": "text",
        }
      },
      {
        "key": "content.rendered",
        "attributes": {
          "type": "textarea",
        }
      },
    ]
  }};
}
