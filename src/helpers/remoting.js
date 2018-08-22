import axios from 'axios';

const port = process.env.PORT || 3003;
const client = axios.create({
  baseURL: `http://localhost:${port}/api`,
  json: true
});

export default {
  async execute(method, resource, data) {
    return client({
      method,
      url: resource,
      data,
    }).then(req => {
      return req.data
    })
  },
  test() {
    return this.execute('get', '/test')
  },
}
