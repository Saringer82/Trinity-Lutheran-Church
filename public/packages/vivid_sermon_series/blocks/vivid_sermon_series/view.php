<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<script type="text/javascript">

$(function(){
	
	//show Week 1 by default
	$(".weekID1").show();	
	
	//dropdown functionality
	$(".sermonSeriesWeekSelector").hover(
		function(){
			$(this).removeClass("closed").addClass("open");
			$(this).find("ul").fadeIn();
		},
		function(){
			$(this).find("ul").fadeOut();
			$(this).removeClass("open").addClass("closed");	
		}
	);
	
	$(".sermonSeriesWeekSelector ul li").click(function(){
		$(".sermonSeriesSelectedWeekTitle").html($(this).html());
		var weekID = $(this).attr("class");
		$(".sermonSeriesVideo, .sermonSeriesAudio, .sermonSeriesNotes").hide();
		$("."+weekID).show();
		$(".sermonSeriesWeekSelector ul").hide();
	});
	
});


function writeConsole(content) {
 top.consoleRef=window.open('','myconsole',
  'width=440,height=30'
   +',menubar=0'
   +',toolbar=1'
   +',status=0'
   +',scrollbars=1'
   +',resizable=1')
 top.consoleRef.document.writeln(
  '<html><head><title>Console</title></head>'
   +'<body bgcolor=white onLoad="self.focus()">'
   +'<embed type="application/x-shockwave-flash" flashvars="audioUrl=' + content + '&autoPlay=true" src="http://prac-gadget.googlecode.com/svn/branches/google-audio-step.swf"  width="400" height="27" quality="best"></embed>'
   +'</body></html>'
 )
 top.consoleRef.document.close()
}
</script>

<div class="sermonSeries" id="sermonSeries<?php echo $bID?>">
	
    <h1><?php echo $seriesTitle?></h1>
    
    <h2><?php echo t('Overview')?></h2>
    
    <p><?php echo $seriesDescription?></p>
        
    <?php  if(!count($items)>0){ ?>
    <div class="well">
        <?php echo t('You did not add any sermon items')?>
    </div>    
    <?php  } else { ?>
    
    <div class="sermonSeriesWeekSelector closed" id="sermonSeriesWeekSelector<?php echo $bID?>">
   		 
        <div class="sermonSeriesSelectedWeek">
            <span class="sermonSeriesSelectedWeekTitle"><?php echo $items[0]['sermonTitle']?></span>
            <img width="20" src="<?php echo $blockURL?>/img/caret.png">
        </div>
        
        <ul>
        	<?php    
			$weekID = 1;
			foreach($items as $item) { 
            ?>
            <li class="weekID<?php echo $weekID?>"><?php echo $item['sermonTitle']?></li>                     
            <?php  $weekID++; } ?>
        </ul>
    
    </div><!-- #sermonSeriesWeekSelector -->
    
    <div class="sermonSeriesVideoContainer" id="sermonSeriesVideoContainer<?php echo $bID?>">
            
        <?php    
        $weekID = 1;
        foreach($items as $item) { 
          if ( $item['video']){
        ?>
        <div class="sermonSeriesVideo weekID<?php echo $weekID?>">
        
            <?php    if($item['vidType']=="vimeo"){ ?>
            <iframe src="http://player.vimeo.com/video/<?php    echo $item['video']; ?>" width="100%" height="420" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            <?php    } 
            if($item['vidType']=="youtube"){  ?>
            <iframe width="100%" height="420" src="//www.youtube.com/embed/<?php    echo $item['video']; ?>" frameborder="0" allowfullscreen></iframe>
            <?php    } ?>            
        
        </div>        
        <?php  }
        $weekID++;
        } ?>
    
    </div><!-- #sermonSeriesVideoContainer -->
    
    <div class="seriesAssetContainer">
    
        <div class="sermonSeriesAudioContainer" id="sermonSeriesAudioContainer<?php echo $bID?>">
        
            <h2><?php echo t('Sermon Audio')?></h2>
            
            <?php    
            $weekID = 1;
            foreach($items as $item){
                if ( $item['afID'] > "0"){
            ?>
            <div class="sermonSeriesAudio weekID<?php echo $weekID?>">
            
                <a href="javascript:writeConsole('<?php  echo View::url('/download_file',$item['afID']); ?>');"><?php   echo  t("Listen Now")?></a> | 
                <a href="<?php    echo View::url('/download_file',$item['afID']); ?>"><?php   echo  t("Download")?></a>       
                
            
            </div>        
            <?php  } else { ?>
            <div class="sermonSeriesAudio weekID<?php echo $weekID; ?>"><?php   echo  t("No Audio Available");?></div>
            <?php  }
            $weekID++;
            } ?>
        
        </div><!-- #sermonSeriesAudioContainer -->
        
        <div class="sermonSeriesNotesContainer" id="sermonSeriesNotesContainer<?php    echo $bID; ?>">
        
            <h2><?php echo t('Sermon Notes')?></h2>
            
            <?php    
            $weekID = 1;
            foreach($items as $item) { 
                if ( $item['pdfID'] > 0){
            ?>
                <div class="sermonSeriesNotes weekID<?php    echo $weekID; ?>"><a href="<?php    echo View::url('/download_file', $item['pdfID']); ?>"><?php    echo t("Sermon Notes"); ?></a></div>        
            <?php  } else {?>
                <div class="sermonSeriesNotes weekID<?php    echo $weekID; ?>"><?php   echo  t("No Sermon Notes Available");?></div>
            <?php  }
            $weekID++;
            } ?>
        
        </div><!-- #sermonSeriesAudioContainer -->
        
    </div><!-- .seriesAssetContainer -->
    
    <?php  } ?>
    
    

</div><!-- #powerSliderShell  -->