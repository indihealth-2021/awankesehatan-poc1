<html>
  <head>
    <title>PDF.js viewer</title>
    <script src="assets/bower_components/pdf.js-viewer/pdf.js"></script> 
    <link rel="stylesheet" href="assets/bower_components/pdf.js-viewer/viewer.css">
    
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style> 
  </head>
 
  <body>
    <div class="pdfjs">
      <?php include "assets/bower_components/pdf.js-viewer/viewer.html" ?>
    </div>
 
    <script>
      <?php if (isset($_GET['pdf'])): ?>
        <?php if (isset($_GET['type']) && $_GET['type'] == 'post'): ?>
          PDFJS.webViewerLoad('assets/tempfiles/<?php echo $_GET['pdf']; ?>');
        <?php else: ?>
          PDFJS.webViewerLoad('assets/files/<?php echo $_GET['pdf']; ?>');
        <?php endif ?>
      <?php endif ?>
    </script> 
  </body>
</html>