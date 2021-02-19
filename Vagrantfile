# -*- mode: ruby -*-
# vi: set ft=ruby :

# 必要なプラグイン
# vagrant plugin install vagrant-vbguest
# vagrant plugin install vagrant-docker-compose

Vagrant.configure("2") do |config|
  # ボックス
  config.vm.box = "centos/7"

  # ポート
  config.vm.network "forwarded_port", guest: 80, host: 80
  config.vm.network "forwarded_port", guest: 5432, host: 5432

  #IPアドレス
  #config.vm.network "private_network", ip: "192.168.33.10"

  # 共有フォルダ
  config.vm.synced_folder ".", "/vagrant", type:"virtualbox"

  # VirtualBoxの設定
  config.vm.provider "virtualbox" do |vb|
    # 名前
    vb.name = "sample_laravel"

    # CPUの数
    vb.cpus = 2

    # メモリ(MB)
    vb.memory = 2048
  end

  # プロビジョン
  config.vm.provision :docker
  config.vm.provision :docker_compose, run: "always", yml: "/vagrant/docker-compose.yml"
end
