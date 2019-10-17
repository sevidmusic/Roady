# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # Box Settings
  config.vm.box = "centos/7"

  # Provider Settings
  config.vm.provider "virtualbox" do |vb|
      vb.memory = "4042"
  end

  # Network Settings
  config.vm.network "private_network", ip: "192.168.33.10"

  # Synced Folder Settings
  config.vm.synced_folder ".", "/var/www/html", :nfs => { :mount_options => ["dmode=777", "fmode=666"] }

  # Provision Settings
  config.vm.provision "shell", path: "bootstrap.sh"
end
