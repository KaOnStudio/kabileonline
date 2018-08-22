const express = require('express');
const router = express.Router();

router.get('/test', function (req, res) {
  res.json({
    data: {
      state: 'OK',
      name: 'Kabile Online',
    }
  })
});

module.exports = router;
