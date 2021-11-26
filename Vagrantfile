Vagrant.configure("2") do |config|
 
  config.vm.box = "bento/ubuntu-20.04"
  config.vm.synced_folder ".", "/vagrant"
  config.vm.provider "virtualbox" do |v|
    v.linked_clone = true
    v.memory = 1024
    v.cpus = 1
  end  

  config.vm.define "web" do |web|
    web.vm.hostname = "web"
    #web.vm.network "public_network"
    web.vm.network "private_network", ip: "192.168.50.4";
  end  

  config.vm.define "web2" do |web2|
    web2.vm.hostname = "web2"
    #web.vm.network "public_network"
    web2.vm.network "private_network", ip: "192.168.50.5";
  end  

  config.vm.define "db" do |db|
    db.vm.hostname = "mysql"
    db.vm.network "private_network", ip: "192.168.50.8";
   
  end
  
  
  config.vm.define "control" do |control|
    control.vm.hostname = "control"
    control.vm.network "private_network" , ip: "192.168.50.9";
    control.vm.provision "shell", inline: <<-SHELL
      sudo apt-get update
      sudo apt-get install -y ansible git sshpass
      sudo ansible-galaxy collection install community.general
      sudo ansible-galaxy collection install community.mysql
    SHELL
    control.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/Fiifi96/Vagrant_Ansible_automation/hosts", destination: "~/hosts"
    control.vm.provision "shell" , inline: "sudo cp hosts /etc/ansible/hosts"
    control.vm.provision "ansible_local" do |ansible|
      ansible.playbook = "control_conf.yml"
    end
    # control.vm.provision "ansible_local" do |ansible|
    #   ansible.playbook = "web1app.yml"
    # end
  end  
  


end