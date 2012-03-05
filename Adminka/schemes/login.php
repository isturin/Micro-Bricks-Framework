<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?=MBReg::get( 'pageTitle' )?></title>
  <style type="text/css">
   body{ background: #fff; }
   #centerLayer {
    position: absolute;
    width: 280px;
    height: 180px;
    left: 50%;
    top: 40%;
    margin-left: -150px;
    margin-top: -100px;
    background: #cdf;
    border: solid 1px black;
    padding: 10px;
    overflow: auto;
   }

   #centerLayer input
   {
    border: 1px solid #aaa;
    width: 100px;
   }

   #centerLayer>table
   {
    margin-top: 50px;
   }
  </style>
 </head>
 <body>
  <div id="centerLayer">
    <?=$this->pageResult?>
  </div>
 </body>
</html>