# INITIAL CONFIGURATION
set :application, "comopromos.com"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/comopromos/comopromos.com"

# USER & PASSWORD
set :user, 'comopromos'
set :password, 'c0m0pr0m0s2012'

# ROLES
role :app, "comopromos.com"
role :web, "comopromos.com"
role :db, "comopromos.com", :primary => true

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
    run "cp /home/comopromos/comopromos.com/current/. /home/comopromos/comopromos.com/ -R"
    run "chmod 666 /home/comopromos/comopromos.com/app/config/database.php"
    run "cp /home/comopromos/comopromos.com/app/config/database.php.srvr /home/comopromos/comopromos.com/app/config/database.php"
    run "chmod 777 /home/comopromos/comopromos.com/app/tmp/ -R"
    run "chmod 777 /home/comopromos/comopromos.com/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/comopromos/comopromos.com/app/webroot/files/uploads/ -R"
  end
  
end