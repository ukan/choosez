
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('http://localhost:8000/froza/toko-ojen/index.html', function () {
        page.render('localhost1666505295_1024_768.jpg');
        phantom.exit();
    });
    