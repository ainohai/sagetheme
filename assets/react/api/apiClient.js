import axios from 'axios';

/**
 * makes XMLHttpRequests
 */
/**params: {
 *     ID: 12345
 *   }
 */
export function getRequest(url, params) {
  axios.get(url, {
    params
  })
    .then(function (response) {
      return response;
    })
    .catch(function (error) {
      console.log(error);
    });
}
