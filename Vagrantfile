$scipt_control = <<-SCRIPT
sudo apt-get update
sudo apt-get install -y ansible git sshpass
sed -i "s/.*#host_key_checking.*/host_key_checking = False/g" /etc/ansible/ansible.cfg 
sudo ansible-galaxy collection install community.general
sudo ansible-galaxy collection install community.mysql

SCRIPT



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
    # web.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/Fiifi96/Vagrant_Ansible_automation/index.html", destination: "~/index.html"
    # web.vm.provision "shell" , inline: "sudo cp index.html /var/www/html/index.html"
    # web.vm.provision "shell" , inline: "sudo rm /var/www/html/index.html"
    
  end  

  config.vm.define "web2" do |web2|
    web2.vm.hostname = "web2"
    #web.vm.network "public_network"
    web2.vm.network "private_network", ip: "192.168.50.5";
    # web2.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/Fiifi96/Vagrant_Ansible_automation/index.html", destination: "~/index.html"
    # web2.vm.provision "shell" , inline: "sudo cp index.html /var/www/html/index.html"
    # web2.vm.provision "shell" , inline: "sudo rm /var/www/html/index.html"
    
  end  

  config.vm.define "db" do |db|
    db.vm.hostname = "mysql"
    db.vm.network "private_network", ip: "192.168.50.8";
   
  end
  
  config.vm.define "haproxy" do |haproxy|
    haproxy.vm.hostname = "haproxy"
    haproxy.vm.network "private_network", ip: "192.168.50.10";
   
  end

  
  config.vm.define "control" do |control|
    control.vm.hostname = "control"
    control.vm.network "private_network" , ip: "192.168.50.9";
    
    control.vm.provision "shell" , inline: $scipt_control
      
    control.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/Fiifi96/Vagrant_Ansible_automation/hosts", destination: "~/hosts"
    control.vm.provision "shell" , inline: "sudo cp hosts /etc/ansible/hosts"

    # control.vm.provision "ansible_local" do |ansible|
    #   ansible.playbook = "control_conf.yml"
    # end

    control.vm.provision "ansible_local" do |ansible|
      ansible.playbook = "webapp.yml"
    end

    control.vm.provision "ansible_local" do |ansible|
      ansible.playbook = "dbplaybook.yml"
    end

    control.vm.provision "ansible_local" do |ansible|
      ansible.playbook = "load_b.yml"
    end

  end  
  


end