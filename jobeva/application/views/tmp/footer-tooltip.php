<script type="text/javascript" src="<?php echo base_url();?>template/bower_components/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/bower_components/tooltipster-master/dist/js/tooltipster-scrollableTip.min.js"></script>
<script>  

$('.tooltips').tooltipster({
    content: 'Loading...',
    theme: 'tooltipster-noir',
    contentAsHTML: true,
    plugins: ['sideTip', 'scrollableTip'],
    functionBefore: function(instance, helper) {
        
        var $origin = $(helper.origin);
        //var boxCount = $('#tot').text();

        var tooltips = $origin.attr('data-tooltip-content');
        // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
        if ($origin.data('loaded') !== true) {

            $.get('<?php echo base_url();?>index.php/talent/talentListBox/<?php echo $id_user;?>/'+tooltips, function(data) {

                // call the 'content' method to update the content of our tooltip with the returned data.
                // note: this content update will trigger an update animation (see the updateAnimation option)
                instance.content(data);

                // to remember that the data has been loaded
                $origin.data('loaded', true);
            });
        }
    }
});



$('.tooltipsdir').tooltipster({
    content: 'Loading...',
    theme: 'tooltipster-noir',
    contentAsHTML: true,
    plugins: ['sideTip', 'scrollableTip'],

    position: 'right',
    positionTracker:true,
    //plugins: ['tooltipster.sideTip', 'laa.scrollableTip'],
    functionBefore: function(instance, helper) {
        
        var $origin = $(helper.origin);
        //var boxCount = $('#tot').text();

        var tooltips = $origin.attr('data-tooltip-content');
        // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
        if ($origin.data('loaded') !== true) {

            $.get('<?php echo base_url();?>index.php/talent/talentListBoxDir/<?php echo $id_user;?>/'+tooltips, function(data) {

                // call the 'content' method to update the content of our tooltip with the returned data.
                // note: this content update will trigger an update animation (see the updateAnimation option)
                instance.content(data);

                // to remember that the data has been loaded
                $origin.data('loaded', true);
            });
        }
    }
});
/*
$('.tooltipsski').tooltipster({
    content: 'Loading...',
    theme: 'tooltipster-noir',
    contentAsHTML: true,
    plugins: ['sideTip', 'scrollableTip'],
    functionBefore: function(instance, helper) {
        
        var $origin = $(helper.origin);
        //var boxCount = $('#tot').text();

        var tooltips = $origin.attr('data-tooltip-content');
        // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
        if ($origin.data('loaded') !== true) {

            $.get('<?php echo base_url();?>index.php/talent/viewskilist/'+tooltips, function(data) {

                // call the 'content' method to update the content of our tooltip with the returned data.
                // note: this content update will trigger an update animation (see the updateAnimation option)
                instance.content(data);

                // to remember that the data has been loaded
                $origin.data('loaded', true);
            });
        }
    }
});
*/


</script>