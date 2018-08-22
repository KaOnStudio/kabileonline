import axios from 'axios';

const client = axios.create({
  baseURL: process.env.API_URL,
  json: true
});

export default {
  async execute(method, path, data) {
    return client({
      method,
      url: path,
      data,
    }).then((req) => {
      if (req.data) {
        return req.data
      }
      return {};
    })
  },
  async get(path, data) {
    return this.execute('get', path, data);
  },
  ping() {
    return this.get('/ping');
  },
}
