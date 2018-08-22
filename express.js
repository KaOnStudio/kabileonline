const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = process.env.PORT || 3003;
const router = express.Router();
const api = require('./server');

app.use(cors());
app.use(bodyParser.json());

// set the static files location for the static html
app.use('/api', api);
app.use(express.static(`${__dirname}/dist`));
app.engine('.html', require('ejs').renderFile);
app.set('views', `${__dirname}/dist`);

router.get('/*', (req, res, next) => {
  res.sendFile(`${__dirname}/dist/index.html`)
});

app.use('/', router);

app.listen(port);
console.log('App running on port', port);
