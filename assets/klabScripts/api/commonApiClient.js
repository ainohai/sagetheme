/**
 * makes all api requests of this app.
 */

import axios from 'axios';

/**params: {
 *     ID: 12345
 *   }
 */
export function getRequest(url, params) {
  console.log(url);
  axios.get(url, {
    params
  })
    .then(function (response) {
      console.log('axios: ' + response.data);
      return response;
    })
    .catch(function (error) {
      console.log(error);
    });
}
