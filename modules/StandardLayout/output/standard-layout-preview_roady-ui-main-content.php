<span id="beginning"></span>
<div class="roady-ui-content-wrapper">
    <h1>Roady UI Main Content (roady-ui-main-content)</h1>
    <p>
        This is what content displayed in the roady-ui-main-content
        will look like if wrapped in a container that is assigned
        the roady-ui-content-wrapper class.
    </p>
    <table>
        <tr>
            <th>Heading 1</th>
            <th>Heading 2</th>
            <th>Heading 3</th>
        </tr>
        <tr>
            <td>Lorem ipsum dolor sit ametconsectetur adipiscing elitduis</td>
            <td>Neque sed accumsan pretiumaenean ipsum ipsumvenenatis in</td>
            <td>Vel lectus sit amet quam consectetur lobortisin</td>
        </tr>
        <tr>
            <td>Vel lectus sit amet quam consectetur lobortisin</td>
            <td>Neque sed accumsan pretiumaenean ipsum ipsumvenenatis in</td>
            <td>Lorem ipsum dolor sit ametconsectetur adipiscing elitduis</td>
        </tr>
        <tr>
            <td>Neque sed accumsan pretiumaenean ipsum ipsumvenenatis in</td>
            <td>Lorem ipsum dolor sit ametconsectetur adipiscing elitduis</td>
            <td>Vel lectus sit amet quam consectetur lobortisin</td>
        </tr>
    </table>
    <h2>Form Style:</h2>
    <p>Below shows how a form will look using the Standard Layout module's styles:</p>
    <form action="/action_page.php">
        <!-- text input -->
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value="John"><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value="Doe"><br><br>
        <!-- radio -->
        <input type="radio" id="html" name="fav_language" value="HTML">
        <label for="html">HTML</label><br>
        <input type="radio" id="css" name="fav_language" value="CSS">
        <label for="css">CSS</label><br>
        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
        <label for="javascript">JavaScript</label>
        <!-- checkbox -->
        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
        <label for="vehicle1"> I have a bike</label><br>
        <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
        <label for="vehicle2"> I have a car</label><br>
        <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
        <label for="vehicle3"> I have a boat</label>
        <!-- textarea -->
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>
        <input type="submit" value="Submit">
    </form>

    <h2>Source Code:</h2>
    <p>
        Below shows how a elements assigned the `.sourceCode` class
        will look using the Standard Layout module's styles:
    </p>
    <div class="sourceCode">
        echo "Hello World";
    </div>
</div>
<?php
$words = 'lorem ipsum dolor sit ametconsectetur adipiscing elitduis '
. 'aliquam suscipit odio sed eleifenddonec scelerisque '
. 'neque sed accumsan pretiumaenean ipsum ipsumvenenatis in '
. 'hendrerit atpulvinar a estaenean fermentum consectetur '
. 'lectussit amet interdum turpis consequat velinteger nunc '
. 'tellusvehicula non pulvinar luctuspharetra vitae '
. 'risussuspendisse at justo at justo mollis imperdiet et '
. 'ac orcinunc in vehicula ligulased lacinia eratvivamus ac '
. 'nisi et mauris convallis rutrum et et nislsed '
. 'gravidamauris in sollicitudin viverraquam risus '
. 'fermentum massaeu sollicitudin lorem orci at sapienduis '
. 'vel lectus sit amet quam consectetur lobortisin '
. 'efficitur lectus congue lacus luctus consecteturnunc '
. 'eget lacus facilisisdignissim nibh velmattis nullain '
. 'ultricies ipsum ut nulla eleifend sagittisduis sit amet '
. 'sapien tempordapibus ligula quissemper nisiquisque '
. 'vulputate metus magnased gravida purus accumsan idmorbi '
. 'placerat diam ut felis euismod bibendum';
$wordCollection = explode(' ', $words);
shuffle($wordCollection);
$date = date('h:i:s A \o\n m/d/Y');
for ($i = 0; $i < random_int(1, random_int(15, 50)); $i++) { ?>
<div class="roady-ui-content-wrapper">
    <h2><?php echo ucfirst($wordCollection[array_rand($wordCollection)]); ?></h2>
    <!-- <img src="roadyLogo.png" width="315" height="307" alt="Roady Logo"> -->
    <img src="https://picsum.photos/<?php echo random_int(100, 500); ?>" width="300" height="300" alt="picsum.photos">
    <?php
    $wordLimit = random_int(100, count($wordCollection));
    $wordsToUse = array_slice($wordCollection, 0, $wordLimit);
    echo '<p>' . ucfirst(implode(' ', $wordsToUse) . '.') . '</p>';
    ?>
<p>Scroll to <a href="#beginning">Beginning</a> of page</p>
<p>Scroll to <a href="#end">End</a> of page</p>
</div>
<?php } ?>
<nav id="end">
    <menu>
        <li>Scroll to <a href="#beginning">Beginning</a> of page</li>
        <li>Page Last Loaded At: <?php echo $date; ?></li>
    </menu>
</nav>

