<?php      
defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<!-- USE FOR IMAGE SELECTOR -->
<style type="text/css">
.select-afID, .select-pdfID { display: block; padding: 15px; cursor: pointer; background: #dedede; border: 1px solid #cdcdcd; text-align: left; color: #333 !important; vertical-align: center; font-size: 12px; }
.select-afID i, .select-pdfID i { margin-right: 10px; font-size: 20px; }
</style>


<style type="text/css">
    .panel-heading { cursor: move; }
        .panel-heading .label-shell { margin-top: 5px; }
            .panel-heading .label-shell label { display: block; text-align: right; }
            .panel-heading .label-shell label i { float: left; margin-top: 3px; cursor: move; }
    .panel-body { display: none; }
        
</style>

<p>
<?php  print Loader::helper('concrete/ui')->tabs(array(
    array('pane-series', t('Series'), true),
    array('pane-sermons', t('Sermons'))
));?>
</p>

<div class="ccm-tab-content" id="ccm-tab-content-pane-series">
    
    <fieldset>
        
        <legend><?php echo t('Series Information')?></legend>
        
        <div class="form-group">
            <?php    echo $form->label('seriesTitle', t('Series Title'));?>
            <?php    echo $form->text('seriesTitle', $seriesTitle);?>   
        </div>
        
        <div class="form-group">
            <?php    echo $form->label('seriesDescription', t('Series Description'));?>
            <?php    echo $form->textarea('seriesDescription', $seriesDescription, array("style"=>"min-height: 100px;"));?>  
        </div>        
        
    </fieldset>

</div>

<div class="ccm-tab-content" id="ccm-tab-content-pane-sermons">
    
    <fieldset>
        
        <legend><?php echo t('Sermons')?></legend>
        
        <div class="well bg-info">
            <?php  echo t('You can rearrange sermons if needed.'); ?>
        </div>
        
        <div class="items-container">
            
            <!-- DYNAMIC ITEMS WILL GET LOADED INTO HERE -->
            
        </div>  
        
        <span class="btn btn-success btn-add-item"><?php  echo t('Add Item') ?></span> 
        
    </fieldset>
    

</div>

<!-- THE TEMPLATE WE'LL USE FOR EACH ITEM -->
<script type="text/template" id="item-template">
    <div class="item panel panel-default" data-order="<%=sort%>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3 label-shell">
                    <label for="sermonTitle<%=sort%>"><i class="fa fa-arrows drag-handle"></i> <?php echo t('Sermon Title')?></label>
                </div>
                <div class="col-xs-5">
                    <input type="text" class="form-control" name="sermonTitle[]" value="<%=sermonTitle%>">    
                </div>
                <div class="col-xs-4">
                    <a href="javascript:editItem(<%=sort%>);" class="btn btn-edit-item btn-default"><?php echo t('Edit Media')?></a>
                <a href="javascript:deleteItem(<%=sort%>)" class="btn btn-delete-item btn-danger"><?php echo t('Delete')?></a>
                </div>
            </div>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label class="col-xs-3 control-label" for="vidType<%=sort%>"><?php echo t('Video Type:')?></label>
                <div class="col-xs-9">
                    <select class="form-control" name="vidType[]" id="vidType<%=sort%>">
                        <option value="vimeo" <%= vidType=='vimeo' ? 'selected' : '' %>><?php echo t('Vimeo')?></option>
                        <option value="youtube" <%= vidType=='youtube' ? 'selected' : '' %>><?php echo t('YouTube')?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label" for="video<%=sort%>"><?php echo t('Video ID:')?></label>
                <div class="col-xs-9">
                    <input class="form-control" type="text" name="video[]" id="video<%=sort%>" value="<%=video%>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label"><?php  echo t('Choose Audio File') ?></label>
                <div class="col-xs-9">
                    <a href="javascript:chooseAudioFile(<%=sort%>);" class="select-afID" id="select-afID-<%=sort%>">
                        <% if (afIDName.length > 0) { %>
                            <i class="fa fa-music"></i>
                            <%=afIDName%>
                        <% } else { %>
                            <i class="fa fa-music"></i>
                            Choose File
                        <% } %>
                    </a>
                    <input type="hidden" name="<?php  echo $view->field('afID')?>[]" class="afID" value="<%=afID%>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label"><?php  echo t('Choose Notes File') ?></label>
                <div class="col-xs-9">
                    <a href="javascript:choosePDFFile(<%=sort%>);" class="select-pdfID" id="select-pdfID-<%=sort%>">
                        <% if (pdfIDName.length > 0) { %>
                            <i class="fa fa-file-text"></i>
                            <%=pdfIDName%>
                        <% } else { %>
                            <i class="fa fa-file-text"></i>
                            Choose File
                        <% } %>
                    </a>
                    <input type="hidden" name="<?php  echo $view->field('pdfID')?>[]" class="pdfID" value="<%=pdfID%>" />
                </div>
            </div>
            <input class="item-sort" type="hidden" name="<?php  echo $view->field('sort')?>[]" value="<%=sort%>"/>
        </div>
    </div><!-- .item -->
</script>


<script type="text/javascript">

//Edit Button
var editItem = function(i){
    $(".item[data-order='"+i+"']").find(".panel-body").toggle();
};
//Delete Button
var deleteItem = function(i) {
    var confirmDelete = confirm('<?php  echo t('Are you sure?') ?>');
    if(confirmDelete == true) {
        $(".item[data-order='"+i+"']").remove();
        indexItems();
    }
};
//Choose Audio File
var chooseAudioFile = function(i){
    var fileShell = $('#select-afID-'+i);
    ConcreteFileManager.launchDialog(function (data) {
        ConcreteFileManager.getFileDetails(data.fID, function(r) {
            jQuery.fn.dialog.hideLoader();
            var file = r.files[0];
            //fileShell.html(file.fileName);
            fileShell.find("i").after(file.fileName);
            fileShell.next('.afID').val(file.fID)
        });
    });
};

//Choose PDF File
var choosePDFFile = function(i){
    var fileShell = $('#select-pdfID-'+i);
    ConcreteFileManager.launchDialog(function (data) {
        ConcreteFileManager.getFileDetails(data.fID, function(r) {
            jQuery.fn.dialog.hideLoader();
            var file = r.files[0];
            fileShell.find("i").after(file.fileName);
            fileShell.next('.pdfID').val(file.fID)
        });
    });
};


//Index our Items
function indexItems(){
    $('.items-container .item').each(function(i) {
        $(this).find('.item-sort').val(i);
        $(this).attr("data-order",i);
    });
};

$(function(){
    
    //DEFINE VARS
    
        //use when using Redactor (wysiwyg)
        var CCM_EDITOR_SECURITY_TOKEN = "<?php  echo Loader::helper('validation/token')->generate('editor')?>";
        
        //Define container and items
        var itemsContainer = $('.items-container');
        var itemTemplate = _.template($('#item-template').html());
    
    //BASIC FUNCTIONS
    
        //Make items sortable. If we re-sort them, re-index them.
        $(".items-container").sortable({
            handle: ".panel-heading",
            update: function(){
                indexItems();
            }
        });
    
    //LOAD UP OUR ITEMS
        
        //for each Item, apply the template.
        <?php  
        if($items) {
            foreach ($items as $item) { 
        ?>
        itemsContainer.append(itemTemplate({
            //define variables to pass to the template.
            sermonTitle: '<?php  echo addslashes($item['sermonTitle']) ?>',
            vidType: '<?php  echo addslashes($item['vidType']) ?>',
            video: '<?php  echo addslashes($item['video']) ?>',
            
            //AUDIO SELECTOR
            afID: '<?php  echo $item['afID'] ?>',
            <?php  if($item['afID']) { ?>
            afIDName: '<?php  echo File::getByID($item['afID'])->getFileName();?>',
            <?php  } else { ?>
            afIDName: '',
            <?php  } ?>
            
            //NOTES SELECTOR
            pdfID: '<?php  echo $item['pdfID'] ?>',
            <?php  if($item['pdfID']) { ?>
            pdfIDName: '<?php  echo File::getByID($item['pdfID'])->getFileName();?>',
            <?php  } else { ?>
            pdfIDName: '',
            <?php  } ?>
            
            sort: '<?php echo $item['sort'] ?>'
        }));
        <?php  
            }
        }
        ?>    
        
        //Init Index
        indexItems();
        
    //CREATE NEW ITEM
        
        $('.btn-add-item').click(function(){
            
            //Use the template to create a new item.
            var temp = $(".items-container .item").length;
            temp = (temp);
            itemsContainer.append(itemTemplate({
                //vars to pass to the template
                sermonTitle: '',
                vidType: '',
                video: '',
                                
                //AUDIO SELECTOR
                afID: '',
                afIDName: '',
                
                //NOTES SELECTOR
                pdfID: '',
                pdfIDName: '',
                               
                sort: temp
            }));
            
            var thisModal = $(this).closest('.ui-dialog-content');
            var newItem = $('.items-container .item').last();
            thisModal.scrollTop(newItem.offset().top);
            
            //Init Index
            indexItems();
        });    

});
</script>