pipeline {
    agent any

    environment {
        AWS_REGION = 'ap-south-1'
        REPO_NAME = 'your-ecr-repo'
        IMAGE_TAG = "${env.BUILD_NUMBER}"
    }

    stages {
        stage('Checkout') {
            steps {
                git credentialsId: 'github-creds', url: 'https://github.com/youruser/your-php-repo.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("${REPO_NAME}:${IMAGE_TAG}")
                }
            }
        }

        stage('Login to ECR') {
            steps {
                script {
                    sh """
                    aws ecr get-login-password --region $AWS_REGION | docker login --username AWS --password-stdin <your_account_id>.dkr.ecr.$AWS_REGION.amazonaws.com
                    """
                }
            }
        }

        stage('Push Docker Image to ECR') {
            steps {
                script {
                    sh "docker tag ${REPO_NAME}:${IMAGE_TAG} <your_account_id>.dkr.ecr.$AWS_REGION.amazonaws.com/${REPO_NAME}:${IMAGE_TAG}"
                    sh "docker push <your_account_id>.dkr.ecr.$AWS_REGION.amazonaws.com/${REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }

        stage('Deploy to ECS') {
            steps {
                script {
                    sh """
                    aws ecs update-service \
                        --cluster your-ecs-cluster-name \
                        --service your-ecs-service-name \
                        --force-new-deployment \
                        --region $AWS_REGION
                    """
                }
            }
        }
    }

    post {
        success {
            echo "Deployment successful!"
        }
        failure {
            echo "Deployment failed!"
        }
    }
}

