
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('http://froza/toko-ojen/index.html', function () {
        page.render('froza2583069294_1024_768.jpg');
        phantom.exit();
    });
    