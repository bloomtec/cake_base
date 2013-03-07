# INITIAL CONFIGURATION
set :application, "excelenter.com"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/bwc_prod/excelenter.com"

# ROLES
role :app, "excelenter.com"
role :web, "excelenter.com"
role :db, "excelenter.com", :primary => true

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/cake_base.git"
set :branch, "excelenter"

# TASKS
namespace :deploy do
  
  task :start do ; end
  
  task :stop do ; end
  
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/bwc_prod/excelenter.com/current/. /home/bwc_prod/excelenter.com/ -R"
    run "chmod 666 /home/bwc_prod/excelenter.com/app/config/database.php"
    run "cp /home/bwc_prod/excelenter.com/app/config/database.php.srvr /home/bwc_prod/excelenter.com/app/config/database.php"
    run "chmod 777 /home/bwc_prod/excelenter.com/app/tmp/ -R"
    run "chmod 777 /home/bwc_prod/excelenter.com/app/webroot/img/uploads/ -R"
    run "chmod 777 /home/bwc_prod/excelenter.com/app/webroot/files/uploads/ -R"
  end
  
end