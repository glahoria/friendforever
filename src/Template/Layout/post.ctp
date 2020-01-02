<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'friends-forever';
?>
<html>
<head>  
    
<?php echo $html->charset(); ?> 

<!-- scripts -->    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<!-- document javascripts -->    
<script type="text/javascript">
    $(document).ready(function () {
        $('#saveForm').submit(function(){
            var formData = $(this).serialize();
            var formUrl = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: formUrl,
                data: formData,
                success: function(data,textStatus,xhr){
                        alert(data);
                },
                error: function(xhr,textStatus,error){
                        alert(textStatus);
                }
            }); 
            return false;
        });
    });
</script>
</head>
<body>
    <?php echo $content_for_layout; ?>
</body>
</html>