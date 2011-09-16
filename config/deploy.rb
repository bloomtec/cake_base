# INITIAL CONFIGURATION
set :application, "futbolparatodos.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/futbolparatodos.co"

# ROLES
role :app, "futbolparatodos.co"
role :web, "futbolparatodos.co"
role :db, "futbolparatodos.co", :primary => true

# DREAMHOST INFORMATION
set :user, "embalao"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/cake_base.git"
set :branch, "bloomweb-fpt"

# TASKS
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/futbolparatodos.co/current/. /home/embalao/futbolparatodos.co/ -R"
    run "chmod 777 /home/embalao/futbolparatodos.co/app/tmp/ -R"
    run "chmod 777 /home/embalao/futbolparatodos.co/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/embalao/futbolparatodos.co/app/webroot/files/uploads/ -R"
  end
end