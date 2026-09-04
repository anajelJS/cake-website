<?php
$errors = [];
$success = false;
$name = '';
$surname = '';
$email = '';
$message = '';
$orderCake = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'form_pro.php';
    $orderCake = $cake;
}

$flavor = $_GET['cake'] ?? 'chocolate';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <h1>Welcome to the cake store</h1>

        <nav class="flavor-nav">
            <a class="<?php echo $flavor === 'chocolate' ? 'active' : ''; ?>" href="index.php?cake=chocolate">Chocolate</a>
            <a class="<?php echo $flavor === 'vanilla' ? 'active' : ''; ?>" href="index.php?cake=vanilla">Vanilla</a>
            <a class="<?php echo $flavor === 'strawberry' ? 'active' : ''; ?>" href="index.php?cake=strawberry">Strawberry</a>
        </nav>

        <section class="showcase">
            <h2>Currently selected cake:</h2>
            <?php
            switch ($flavor) {
                case 'chocolate':
                    include 'chocolate.php';
                    break;
                case 'vanilla':
                    include 'vanilla.php';
                    break;
                case 'strawberry':
                    include 'strawberry.php';
                    break;
                default:
                    include 'chocolate.php';
                    break;
            }
            ?>
        </section>

        <h2>Order a cake:</h2>
        <form method="POST" action="index.php?cake=<?php echo htmlspecialchars($flavor); ?>" class="order-form">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <?php if ($success): ?>
                    <p class="success">Your order has been submitted</p>
                <?php else: ?>
                    <div class="errors">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">

            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($surname); ?>">

            <label for="cake">Cake:</label>
            <select id="cake" name="cake">
                <option value="chocolate" <?php echo ($orderCake ?: $flavor) === 'chocolate' ? 'selected' : ''; ?>>Chocolate</option>
                <option value="vanilla" <?php echo ($orderCake ?: $flavor) === 'vanilla' ? 'selected' : ''; ?>>Vanilla</option>
                <option value="strawberry" <?php echo ($orderCake ?: $flavor) === 'strawberry' ? 'selected' : ''; ?>>Strawberry</option>
            </select>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <label for="message">Message:</label>
            <textarea id="message" name="message"><?php echo htmlspecialchars($message); ?></textarea>

            <button type="submit">Order Cake</button>
        </form>
    </div>
</body>
</html>
