@Library('ised-cicd-lib') _

pipeline {
    agent {
        label 'php-8.1'
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
