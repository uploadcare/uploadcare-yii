# Uploadcare Yii Framework Extension

This is an extension for [Yii Framework][4] to work with [Uploadcare][1]

It's based on a [uploadcare-php][3] library.

## Requirements

- Yii 1.1+
- PHP 5.2+

## Install

Clone extension from git to your extension directory:

    git clone git://github.com/uploadcare/uploadcare-yii.git extension/uploadcare --recursive
        
Edit your config/main.php to like like this:
    
    Yii::app()->params->uploadcare = array(
        'public_key' => 'demopublickey',
        'secret_key' => 'demoprivatekey',
    );
    
    return array(
      'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
      'name'=>'Yii Framework: Uploadcare Demo',
      'import' => array(
          'application.extensions.uploadcare.CUploadcare',
      ),    
    );

Now you can access object of class Uploadcare_Api like this:

    CUploadcare::api()

## Usage

Create a controller:

    class SiteController extends CController
    { 
      /**
       * This is the default action that displays the phonebook Flex client.
       */
      public function actionIndex()
      {
        if (isset($_POST['file_id'])) {
          $file_id = $_POST['file_id'];
          $file = CUploadcare::api()->getFile($file_id);
          $file->store();
        }
        $this->render('index', array('file' => $file));
      }
    }

Inside your view you can initialize Uploadcare widget. This will show a &lt;script&gt; section:

    <?php echo CUploadcare::api()->widget->getScriptTag(); ?>

Display form:

    <?php echo CHtml::beginForm(); ?>
    <div class="row">
      <?php echo CHtml::hiddenField('file_id', '', array('role' => 'uploadcare-uploader')); ?>
    </div>
    <div class="row submit">
      <?php echo CHtml::submitButton('Go!'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
    
Don't forget to provide "array('role' => 'uploadcare-uploader')" so widget will display properly.

You should see a from with Uploadcare widget. Upload a file a press "Go!". 

This code inside a controller will store a file and it will be available at CDN:

    if (isset($_POST['file_id'])) {
      $file_id = $_POST['file_id'];
      $file = CUploadcare::api()->getFile($file_id);
      $file->store();
    }
    
You can use "$file" inside your view to display file and call different operations:

    <?php echo $file->scaleCrop(300, 300, true)->getImgTag(); ?>

[You can find out more about CDN here][2]

[1]: https://uploadcare.com/
[2]: https://uploadcare.com/documentation/reference/basic/cdn.html
[3]: https://github.com/uploadcare/uploadcare-php
[4]: http://www.yiiframework.com/