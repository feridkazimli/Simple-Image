require_once "class.simpleImage.php";

// Connect object

$simpleImage = new simpleImage();

// Get İmage

$simpleImage -> getImage("image.jpg");

// Create a folder and save image

$simpleImage -> smallImageToSaveFolder("small");

