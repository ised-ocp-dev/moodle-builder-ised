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
    	stage('build') {
			steps {
				script {
					sh"""
						git clone -b MOODLE_38_STABLE https://github.com/ised-isde-canada/moodle.git
						rm -rf moodle/.git
						mv -r moodle/ .
					"""
	    			builder.buildS2IAppFromDir("${IMAGE_NAME}", "${BUILD_NAME}", ".")
				}
			}
    	}
    }
}
