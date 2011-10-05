# INITIAL CONFIGURATION
set :application, "colors.bloomweb.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/colors.bloomweb.co"

# ROLES
role :app, "colors.bloomweb.co"
role :web, "colors.bloomweb.co"
role :db, "colors.bloomweb.co", :primary => true

# DREAMHOST INFORMATION
set :user, "embalao"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/colors.git"
set :branch, "master"

# TASKS
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/colors.bloomweb.co/current/. /home/embalao/colors.bloomweb.co/ -R"
    run "chmod 777 /home/embalao/colors.bloomweb.co/app/tmp/ -R"
    run "chmod 777 /home/embalao/colors.bloomweb.co/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/embalao/colors.bloomweb.co/app/webroot/files/uploads/ -R"
  end
end