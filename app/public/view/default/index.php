<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
    </head>

    <body>
        <?php if (!empty($this->get("error"))) { ?>
            <div><?php echo $this->getErrorMsg(); ?></div>
        <?php }else{ ?>
            <div>Valori initiale</div>
            <div><?php echo $this->initialValue[0] ?></div>
            <div><?php echo $this->initialValue[1] ?></div>
            <hr></hr>
            <div><?php echo $this->battleDetails ?></div>
            <div><?php echo $this->winner ?> a castigat jocul!</div>
        <?php } ?>
    </body>
</html>