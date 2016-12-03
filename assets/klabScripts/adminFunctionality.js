import * as commonApiClient from './api/commonApiClient';

export default class AdminFunctionality {
  constructor() {
    console.log("admin is constructed");
    var url = 'http://52.18.72.234/klefstromlab/wp-json/wp/v2/posts';
    var result = commonApiClient.getRequest(url, null);
    console.log(result);
  }
}
