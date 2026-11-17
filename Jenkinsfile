@Library('ised-cicd-lib') _

pipeline {
    agent {
        label 'php-8.4'
    }

    options {
        disableConcurrentBuilds()
    }

   	environment {
		// GLobal Vars
		IMAGE_NAME = "dsdmdl-moodle"
        TARGET_ROSA_REGISTRY = "${params.env_dev}"
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
