# INITIAL CONFIGURATION
set :application, "colorstennis.com"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/colostennis/colorstennis.com"

# ROLES
role :app, "colorstennis.com"
role :web, "colorstennis.com"
role :db, "colorstennis.com", :primary => true

# DREAMHOST INFORMATION
set :user, "colostennis"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/cake_base.git"
set :branch, "colors"

# TASKS
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/colostennis/colorstennis.com/current/. /home/colostennis/colorstennis.com/ -R"
    run "chmod 777 /home/colostennis/colorstennis.com/app/tmp/ -R"
    run "chmod 777 /home/colostennis/colorstennis.com/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/colostennis/colorstennis.com/app/webroot/files/uploads/ -R"
  end
end