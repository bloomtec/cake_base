set :application, "example.com"
set :repository,  "git@github.com:ajiaco/riviera.git"
set :branch, "master"
set :scm, :git 
set :deploy_to, "/var/www"
set :deploy_via, :remote_cache # see http://www.capify.org/index.php/Understanding_Deployment_Strategies
# Configuration of you app path in the repo
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
# Nice optional configurations
set :use_sudo, false # don't need this on most setup
set :keep_releases, 5  # only keep 10 version to save space
set :copy_exclude, [".git",".gitignore"] # or any match like [".svn","/documents-on-repo-but-dont-deploy"] 

# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`
set :user,                  'root'
set :password,              'riviera' 
role :web, "50.57.100.106"                          # Your HTTP server, Apache/etc
role :app, "50.57.100.106"                          # This may be the same as your `Web` server
role :db,  "50.57.100.106", :primary => true # This is where Rails migrations will run
#role :db,  "your slave db-server here"

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

# If you are using Passenger mod_rails uncomment this:
 namespace :deploy do
   task :start do ; end
   task :stop do ; end
   task :restart, :roles => :app, :except => { :no_release => true } do
    sudo 'apache2ctl restart'
   end
   
   task :copy_htaccess do
   sudo  'mv /var/www/current/app/config/htaccess_root /var/www/current/.htaccess'
   sudo  'mv /var/www/current/app/config/htaccess_app /var/www/current/app/.htaccess'
   sudo  'mv /var/www/current/app/onfig/htaccess_webroot /var/www/current/app/webroot/.htaccess'   
    sudo 'chmod -R 0755 /var/www/current/.htaccess'
    sudo 'chmod -R 0755 /var/www/current/app/.htaccess'
    sudo 'chmod -R 0755 /var/www/current/app/webroot/.htaccess'
        sudo 'apache2ctl restart'


   end
   
   task :keep_pics do
   sudo 'mv /var/www/current/app/webroot/img/pictures /tmp'

   end
   
   task :recover_pics do
   sudo 'rm -rf /var/www/current/app/webroot/img/pictures'
   sudo 'mv  /tmp/pictures /var/www/current/app/webroot/img'
   sudo 'rm -rf /tmp/pictures'

   end
   
   task :clean_pics do
   sudo 'rm -rf /tmp/pictures'
   sudo 'rm -rf /var/www/current/app/webroot/img/pictures'
   end
   
   task :init_pics do
   sudo 'mkdir /var/www/current/app/webroot/img/pictures'
   	sudo 'chmod -R 0777 /var/www/current/app/webroot/img/pictures'

   end
   
   task :permissions do
#   sudo 'mkdir /var/www/current/app/tmp'
#   sudo 'mkdir /var/www/current/app/tmp/cache'
#   sudo 'mkdir /var/www/current/app/tmp/cache/persistent'
#   sudo 'mkdir /var/www/current/app/tmp/cache/models'
    sudo 'chmod -R 0777 /var/www/current/app/tmp'
    sudo 'chmod -R 0777 /var/www/current/app/tmp/cache'
    sudo 'chmod -R 0777 /var/www/current/app/tmp/cache/persistent'
    sudo 'chmod -R 0777 /var/www/current/app/tmp/cache/models'
	  sudo 'chmod -R 0777 /var/www/current/app/webroot/img/pictures'
	 

   end
 end
 
 
before 'deploy',             'deploy:keep_pics'
after 'deploy',             'deploy:permissions'
after 'deploy',             'deploy:recover_pics'
