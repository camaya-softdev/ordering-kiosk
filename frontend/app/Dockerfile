FROM node:18.15.0

WORKDIR /app

COPY /app/ordering-kiosk/entrypoint.sh /entrypoint.sh
RUN sed -i 's/\r$//' /entrypoint.sh
RUN chmod +x /entrypoint.sh

ADD ./app/ordering-kiosk .

RUN npm config set fetch-retry-maxtimeout 120000
RUN npm i -g vite
RUN npm install --include=dev

ENTRYPOINT ["/entrypoint.sh"]

CMD ["npm", "run", "dev"]