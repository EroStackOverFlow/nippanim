# deploy.rb

set   :application,   "nippanim"
set   :deploy_to,     "/"
set   :domain,        "nippanim.3eeweb.com"

set   :scm,           :git
set   :repository,    "ssh-gitrepo-domain.com:/path/to/repo.git"

role  :web,           domain
role  :app,           domain, :primary => true

set   :use_sudo,      false
set   :keep_releases, 3