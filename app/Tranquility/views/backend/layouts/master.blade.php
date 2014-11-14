<?php echo $this->doctype()."\n"; ?>
<html lang="en"> <!-- TODO: Language type -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
    // Display page title   
    echo $this->headTitle()
        ->setIndent('    ')."\n";
    
    // Setup metadata in header
    echo $this->headMeta()
        ->setIndent('    ')."\n";
    
    // Add additional links in header
    echo $this->headLink()
              ->setIndent('    ')
              ->appendStylesheet('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700')
              ->appendStylesheet($this->baseUrl().'/_resources/_common/css/bootstrap/bootstrap.min.css')  
              ->appendStylesheet($this->baseUrl().'/_resources/_common/css/bootstrap/plugins/datepicker.css') 
              ->appendStylesheet($this->baseUrl().'/_resources/backoffice/css/common.css');
    
    // Check configuration to determine whether to load jQuery from a CDN
    $config = Zend_Registry::get('config');
    $javascriptConfig = $config['tranquility']['js'];
    if ($javascriptConfig['useCdn'] != true) {
        // Set local path for jQuery and jQuery UI
        $this->jQuery()->setLocalPath($this->baseUrl().$javascriptConfig['commonScriptPath'].'/jquery/'.$javascriptConfig['jqueryVersion'].'/jquery.min.js');
        $this->jQuery()->setUiLocalPath($this->baseUrl().$javascriptConfig['commonScriptPath'].'/jqueryui/'.$javascriptConfig['jqueryUiVersion'].'/jquery-ui.min.js');
    }
    
    // Add jQuery in header
    echo $this->jQuery()
              ->setVersion($javascriptConfig['jqueryVersion'])
              ->setUiVersion($javascriptConfig['jqueryUiVersion'])
              ->enable()
              ->uiEnable();
    
    // Add additional javascript
    $headScript = $this->headScript();
    $headScript->setIndent('    ')
               ->prependFile($this->baseUrl().$javascriptConfig['bootstrap']['baseScriptPath'].'/bootstrap.min.js')
               ->prependFile($this->baseUrl().'/_resources/backoffice/scripts/core.js');
    
    // Add additional bootstrap plugins
    foreach ($javascriptConfig['bootstrap']['plugins'] as $pluginName) {
        $headScript->appendFile($this->baseUrl().$javascriptConfig['bootstrap']['pluginScriptPath'].'/'.$pluginName.'/'.$pluginName.'.js');
    }
    echo $headScript;
?>
</head>

<body>
    
    <!-- Heading bar -->
    <div class="navbar navbar-fixed-top">
        <div class="container">
            <!-- Site name and menu toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->url(array(), 'backoffice_index'); ?>"><?php echo $config['backoffice']['sitename']; ?></a>
            </div>
            
            <div class="navbar-collapse collapse">
                <!-- Top level navigation links -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $this->url(array(), 'people_list'); ?>">people</a></li>
                    <li><a href="<?php echo $this->url(array(), 'content_list'); ?>">content</a></li>
                    <li><a href="#">store</a></li>
                    <li><a href="#">reports</a></li>
                    <li><a href="#">settings</a></li>
                </ul>
                
                <!-- System status plugin -->
                <p class="navbar-text pull-right">
                    <?php echo $this->placeholder('systemStatus'); ?>
                </p>
            </div>
        </div>
    </div>
    <!-- End of heading bar -->
    
    <!-- Start of main container -->
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            
            <?php echo $this->partial('partials/breadcrumbs.phtml', array('elements' => $this->breadcrumbs))."\n"; ?>
            
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle menu</button>
                </p>
                
                <div>
                    
                    <?php echo $this->partial('partials/heading.phtml', $this->heading)."\n"; ?>  
                </div>
                
                <div id="message-container">
                    <?php echo $this->flashMessenger()."\n"; ?>
                </div>
                
                <!-- Component -->
                <div>
                <?php echo $this->layout()->content; ?>
                </div>
                <!-- End of component -->
            </div>
            
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <?php echo $this->partial('partials/toolbar.phtml', array('elements' => $this->toolbar))."\n"; ?>
            </div>
        </div>
        
        <hr>

        <footer>
          <p>&copy; Tranquility 2013</p>
        </footer>
        
    </div>
    
    <!-- Container for modal dialog -->
    <div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modal-dialog-heading" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </body>
</html>

  
    