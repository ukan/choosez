
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('fhttp://stackoverflow.com/questions/757675/website-screenshots-using-php', function () {
        page.render('stackoverflow.com3686200276_1024_768.jpg');
        phantom.exit();
    });
    