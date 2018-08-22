import axios from 'axios';

const port = process.env.PORT || 3003;

const client = axios.create({
  baseURL: `${window.location.protocol}//${window.location.hostname}:${port}/api`,
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
