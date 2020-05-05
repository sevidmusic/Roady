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
#
# Note: There is an issue with Vagrant creating duplicate entries in /etc/exports. which causes vagrant up to fail
#      with error mount.nfs not supported. This error message is very unhelpful, after digging, the following post
#      on github was found that solves the issue, just remove Vagrants entries from /etc/exports to force vargant
#      to correctly re-create entries.
#
#Post: https://github.com/hashicorp/vagrant/issues/9666
#
#See wallfantasy's comment from Aug, 15, 2018
#
#"I faced the similar problem on my ubuntu 18.04 host but in my case I found vagrant generated duplicate record in /etc/exports. I delete one of it and reload the box then the problem solved.
#
#Might be helpful for ubuntu users as mentioned by OP. Not sure about mac as OP deleted exports file."
#

