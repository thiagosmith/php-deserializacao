<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serialised Data Viewer</title>
    <!-- Include Tailwind CSS -->
        <link href="../css/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom style to adjust the container width */
        .content-container {
            width: fit-content;
            max-width: 100%;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8 content-container">
        <h1 class="text-2xl font-bold mb-4">Serialised Data Viewer</h1>
        <?php
        // Enable error reporting and display all errors
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require 'test.php';
        class UserData {
            private $data;

            public function __construct($data) {
                $this->data = $data;
            }

            public function getData() {
                return $this->data;
            }
        }

        // Check if the 'encode' parameter is set in the URL
        if(isset($_GET['encode'])) {
            $userData = new UserData($_GET['encode']);
            $serializedData = serialize($userData);
            $base64EncodedData = base64_encode($serializedData);
            ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <p class="font-bold">Normal Data:</p>
                <p><?php echo $_GET['encode']; ?></p>
                <p class="font-bold mt-4">Serialized Data:</p>
                <p><?php echo $serializedData; ?></p>
                <p class="font-bold mt-4">Base64 Encoded Data:</p>
                <p><?php echo $base64EncodedData; ?></p>
            </div>
            <?php
        } elseif(isset($_GET['decode'])) {
            $base64EncodedData = $_GET['decode'];
            $serializedData = base64_decode($base64EncodedData);
            $test = unserialize($serializedData);
            ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <p class="font-bold">Base64 Encoded Serialized Data:</p>
                <p><?php echo $base64EncodedData; ?></p>
                <p class="font-bold mt-4">Serialized Data:</p>
                <p><?php echo $serializedData; ?></p>
                <p class="font-bold mt-4">Deserialized Object:</p>
                <pre><?php print_r($test); ?></pre>
            </div>
            <?php
        } else {
            ?>
            <p class="text-red-600">Please provide either 'encode' or 'decode' parameter in the URL.</p>
            <?php
        }
        ?>
    </div>
</body>

</html>
