@Library('ised-cicd-lib') _

pipeline {
	agent any
	
    options {
        disableConcurrentBuilds()
    }
  
   	environment {
		// GLobal Vars
		IMAGE_NAME = "dsdmdl-moodle"
		BUILD_NAME = "dsdmdl-moodle"
    }
  
    stages {
		stage('checkout-moodle') {
			steps {
				script {
					sh"""
						if [ -d "moodle" ]; then rm -Rf moodle; fi
						pwd
						ls -l
					"""
				}

				dir("moodle") {
					git branch: 'MOODLE_38_STABLE',
						url: 'https://github.com/ised-isde-canada/moodle.git'

					script {
						sh"""
						pwd
						ls -l
							git cherry-pick origin/MDL-63219-M38
							git cherry-pick origin/MDL-66856-M38
							git cherry-pick origin/MDL-67554-M38
							git cherry-pick origin/MDL-67802-M38
							git cherry-pick origin/MDL-52810-M38
							git cherry-pick origin/MDL-61880-M38
							git cherry-pick origin/MDL-64969-M38
							git cherry-pick origin/MDL-68257-M38
							git cherry-pick origin/MDL-68337-M38
							git cherry-pick origin/MDL-68766b-M38
							
						"""
					}
				}

				script {
					sh"""
						cd moodle && \
							rm -rf .git && \
							rm -rf composer.* && \
							mv * ../
						rm -rf moodle/
						pwd
						ls -l
					"""
				}
			}
		}
		stage('build') {
			steps {
				script {
					builder.buildS2IAppFromDir("${IMAGE_NAME}", "${BUILD_NAME}", ".")
				}
			}
		}
    }
}
