import axios from 'axios';

const client = axios.create({
  baseURL: process.env.API_URL,
  json: true
});

export default {
  async execute(method, resource, data) {
    return client({
      method,
      url: resource,
      data,
    }).then((req) => {
      if (req.data) {
        return req.data
      }
      return {};
    })
  },
  test() {
    return this.execute('get', '/test');
  },
}
