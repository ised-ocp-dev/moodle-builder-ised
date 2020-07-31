@Library('ised-cicd-lib') _

pipeline {
    agent {
        label 'php-7.3'
    }

    options {
        disableConcurrentBuilds()
    }

   	environment {
		// GLobal Vars
		IMAGE_NAME = "dsdmdl-moodle"
    }

    stages {
    	stage('build') {
			steps {
				script {
                    builder.buildApp("${IMAGE_NAME}")
				}
			}
    	}
    }
}
