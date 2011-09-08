# INITIAL CONFIGURATION
set :application, "ez.bloomweb.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/ez.bloomweb.co"

# ROLES
role :app, "ez.bloomweb.co"
role :web, "ez.bloomweb.co"
role :db, "ez.bloomweb.co", :primary => true

# DREAMHOST INFORMATION
set :user, "embalao"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/cake_base.git"
set :branch, "master"

# TASKS
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/ez.bloomweb.co/current/. /home/embalao/ez.bloomweb.co/ -R"
    run "chmod 777 /home/embalao/ez.bloomweb.co/app/tmp/ -R"
    run "chmod 777 /home/embalao/ez.bloomweb.co/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/embalao/ez.bloomweb.co/app/webroot/files/uploads/ -R"
  end
end