FROM php:8.2-cli
WORKDIR /app
COPY . .
EXPOSE 10000
CMD ["sh", "-c", "find . -name index.php | head -20; DIR=$(find . -name index.php -exec dirname {} \\; | head -1); echo \"Serving $DIR\"; php -S 0.0.0.0:$PORT -t $DIR"]
