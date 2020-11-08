<div class="output font-concert-one">
    <p>Welcome to the Darling Data Management System, a tool designed to aide in the development of well organized PHP applications.</p>
    <p>View The Darling Data Management System  GitHub.com:</p>
    <p><a href="https://github.com/sevidmusic/DarlingDataManagementSystem">https://github.com/sevidmusic/DarlingDataManagementSystem</a></p>
    <h3>Component's Info</h3>
    <p>Name: <?php echo $this->getName(); ?></p>
    <p>Type: <?php echo $this->getType(); ?></p>
    <p>Unique Id: <?php echo substr($this->getUniqueId(), 0, 61); ?>...</p>
    <p>Storage Location: <?php echo $this->getLocation(); ?></p>
    <p>Storage Container: <?php echo $this->getContainer(); ?></p>
</div>

