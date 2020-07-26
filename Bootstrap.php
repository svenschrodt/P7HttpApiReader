<?php declare(strict_types = 1);
/**
 * Example bootstrapping for namespace /ProjectName/
 *  
 * @package ProjectName
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2020-03-11
 * @link https://github.com/svenschrodt/PictureWitch
 * @license https://github.com/svenschrodt/PictureWitch/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
                    
define('PW_NS', '\\P7HttpApiReader');
define('PW_LIB_DIR', 'P7HttpApiReader');

// Change cwd to location of this file
chdir(dirname(__FILE__));


/**
 * Auto loading for project classes 
 */
spl_autoload_register(function ($className) {
    
    // Check if namespace of class to be instantiated is belonging to us (PW_LIB_DIR)
    
    if (substr($className, 0, strlen(PW_LIB_DIR)) === PW_LIB_DIR) {
        $file = 'src/private/' . str_replace('\\', '/', $className) . '.php';
        
        // Check if destination class file exists
        if (file_exists($file)) {
            require_once $file;
        } else { // trow exception, if not
            throw new Exception("NO SUCH FILE OR DIRECTORY: {$file}");
        }
    }
    
});

