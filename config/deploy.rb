# INITIAL CONFIGURATION
set :application, "clickneat.bloomweb.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/clickneat.bloomweb.co"

# USER & PASSWORD
set :user, 'embalao'
set :password, 'Cobr@Verde'

# ROLES
role :app, "clickneat.bloomweb.co"
role :web, "clickneat.bloomweb.co"
role :db, "clickneat.bloomweb.co", :primary => true

# DREAMHOST INFORMATION
set :user, "embalao"

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/cake_base.git"
set :branch, "clickneat"

# TASKS
namespace :deploy do
  
  task :start do ; end
  
  task :stop do ; end
  
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/clickneat.bloomweb.co/current/. /home/embalao/clickneat.bloomweb.co/ -R"
    run "cp /home/embalao/clickneat.bloomweb.co/app/config/database.srvr /home/embalao/clickneat.bloomweb.co/app/config/database.php"
    run "chmod 777 /home/embalao/clickneat.bloomweb.co/app/tmp/ -R"
    run "chmod 777 /home/embalao/clickneat.bloomweb.co/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/embalao/clickneat.bloomweb.co/app/webroot/files/uploads/ -R"
  end
  
end

namespace :extras do
  
  task :start do ; end
  
  task :stop do ; end
  
  task :restart, :roles => :app, :except => { :no_release => true } do ; end
  
  task :download_uploads do
    run "scp -r embalao@bloomweb.co:/home/embalao/clickneat.bloomweb.co/app/webroot/img/uploads /var/www/clickneat/app/webroot/img/uploads";
  end
  
end