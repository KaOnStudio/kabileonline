import axios from 'axios';

const port = process.env.PORT || 3003;

console.log(process.env);
const client = axios.create({
  baseURL: process.env.API_URL || `http://localhost:${port}/api`,
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
