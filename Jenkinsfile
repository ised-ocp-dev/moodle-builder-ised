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
						git clone -b MOODLE_38_STABLE https://github.com/ised-isde-canada/moodle.git
					"""
				}
				workdir("moodle") {
					script {
						sh"""
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
						rm -rf moodle/.git
						rm -rf moodle/composer.*
						cd moodle && mv * ../
						rm -rf moodle/
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
