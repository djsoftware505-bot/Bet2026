FROM php:8.2-cli
WORKDIR /app
COPY . .
EXPOSE 10000
CMD ["sh", "-c", "if [ -f Bet2026/index.php ]; then php -S 0.0.0.0:$PORT -t Bet2026; else php -S 0.0.0.0:$PORT -t .; fi"]
